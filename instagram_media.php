<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Instagram_media
 * عرض قائمة الوسائط المنشورة / الفاشلة / قيد الانتظار
 * مع فلاتر بسيطة.
 */
class Instagram_media extends CI_Controller
{
    private const MAIN_SESSION_USER_KEY = 'user_id';

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(['url','form','text']);
        $this->load->model('Instagram_reels_model');
    }

    private function uid() {
        $u = (int)$this->session->userdata(self::MAIN_SESSION_USER_KEY);
        if ($u <= 0) {
            redirect('home/login?redirect='.rawurlencode(site_url('instagram_media/listing')));
            exit;
        }
        return $u;
    }

    public function listing() {
        $user_id = $this->uid();

        // فلاتر من GET
        $filter = [
            'ig_user_id'  => trim($this->input->get('ig_user_id')),
            'status'      => trim($this->input->get('status')),
            'media_kind'  => trim($this->input->get('media_kind')),
            'q'           => trim($this->input->get('q'))
        ];
        foreach ($filter as $k=>$v) {
            if ($v==='') unset($filter[$k]);
        }

        $page   = max(1, (int)$this->input->get('page'));
        $limit  = 30;
        $offset = ($page-1)*$limit;

        $items = $this->Instagram_reels_model->get_by_user($user_id,$filter,$limit,$offset);
        $total = $this->Instagram_reels_model->count_by_user($user_id,$filter);
        $summary = $this->Instagram_reels_model->summary_counts($user_id);

        // حسابات IG لفلتر السريع
        $accounts = $this->db->select('ig_user_id, ig_username, page_name')
                             ->from('facebook_rx_fb_page_info')
                             ->where('user_id',$user_id)
                             ->where('ig_linked',1)
                             ->where('ig_user_id IS NOT NULL', null,false)
                             ->order_by('page_name','ASC')
                             ->get()->result_array();

        $data = [
            'items'    => $items,
            'total'    => $total,
            'page'     => $page,
            'limit'    => $limit,
            'pages'    => ceil($total / $limit),
            'filter'   => $filter,
            'summary'  => $summary,
            'accounts' => $accounts,
            'just_published_id' => (int)$this->input->get('rid')
        ];
        $this->load->view('instagram_media', $data);
    }
}