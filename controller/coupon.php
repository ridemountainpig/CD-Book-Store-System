<?php

use model\Model;
require_once("member.php");

class Coupon extends Model {

    protected $table = 'coupon';

    // 發送免運券給信用分數大於80的會員
    public function sendFreeShippingCoupon() {
        $member = new Member();

        $memberList = $member->getMemberCredit();
        $month = date("Y-m");
        foreach ($memberList as $value) {
            $sql = $this->insert(['member_id' => $value['member_id'], 'feature' => 'free-shipping', 'coupon_month' => $month]);
            $this->execute($sql);
        }
    }

    // 查詢某個member_id擁有的coupon
    public function getCoupon($param) {
        $member_id = $param['member_id'];
        $sql = $this->select($this->table) . $this->where('member_id', '=', $member_id);

        return $this->execute($sql);
    }

    public function useCoupon($order_id, $coupon_id) {
        $sql = $this->update(['order_id' => $order_id]) . $this->where('coupon_id', '=', $coupon_id);

        return $this->execute($sql);
    }
}
