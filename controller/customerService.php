<?php

use model\Model;

require("orderList.php");

class CustomerService extends Model {

    public function createCsRecord($order_id) {
        $sql = $this->insert(['cs_id' => '1', 'topic' => 'product', 'order_id' => $order_id], 'cs_record');

        return $this->execute($sql);
    }

    public function getCsRecordByCsId($param) {
        $orderList = new OrderList();
        $cs_id = $param['cs_id'];
        $sql = $this->select('cs_record') . $this->where('cs_id', '=', $cs_id);
        $result = $this->execute($sql);
        for ($i = 0; $i < count($result); $i++) {
            // order, member, product info
            $cs_record_id = $result[$i]['cs_record_id'];
            $sql = $this->select('cs_record', ['order_id']) . $this->where('cs_record_id', '=', $cs_record_id);
            $order_id = $this->execute($sql)[0]['order_id'];
            $result[$i]['order_info'] = $orderList->getOrderByOrderId($order_id);

            // unread message count
            $sql = $this->select('cs_message') . $this->where('cs_record_id', '=', $cs_record_id) . $this->and('msg_by', '=', 'member') . $this->and('msg_state', '=', 'unread');
            $result[$i]['unread_count'] = count($this->execute($sql));
        }

        return $result;
    }

    public function searchMsgByMsgId($message_id) {
        $sql = $this->select('cs_message') . $this->where('message_id', '=', $message_id);

        return $this->execute($sql);
    }

    public function createCsMessage($param) {
        $cs_record_id = $param['cs_record_id'];
        $msg_content = $param['msg_content'];
        $msg_by = $param['msg_by'];
        $create_time = date("Y-m-d H:i:s");
        $msg_state = 'unread';
        $sql = $this->insert(['cs_record_id' => $cs_record_id, 'msg_content' => $msg_content, 'msg_by' => $msg_by, 'create_time' => $create_time, 'msg_state' => $msg_state], 'cs_message');

        $message_id = $this->execute($sql);
        return $this->searchMsgByMsgId($message_id);
    }

    public function readMsg($message_id) {
        $sql = $this->update(['msg_state' => 'read'], 'cs_message') . $this->where('message_id', '=', $message_id);

        $this->execute($sql);
    }

    public function searchUnreadMsg($param) {
        $cs_record_id = $param['cs_record_id'];
        $msg_by = $param['msg_by'];
        $sql = $this->select('cs_message') . $this->where('cs_record_id', '=', $cs_record_id) . $this->and('msg_by', '=', $msg_by) . $this->and('msg_state', '=', 'unread');

        $result = $this->execute($sql);
        foreach ($result as $value) {
            $this->readMsg($value['message_id']);
        }
        return $result;
    }

    public function searchMsgByCsRecId($param) {
        $cs_record_id = $param['cs_record_id'];
        $read_who = $param['read_who'];
        $sql = $this->select('cs_message') . $this->where('cs_record_id', '=', $cs_record_id);

        $result = $this->execute($sql);
        foreach ($result as $value) {
            if ($value['msg_by'] == $read_who) {
                $this->readMsg($value['message_id']);
            }
        }

        return $result;
    }

    public function searchOrderInfoByCsRecId($param) {
        $orderList = new OrderList();

        $cs_record_id = $param['cs_record_id'];
        $search_by = $param['search_by'];
        $sql = $this->select('cs_record', ['order_id']) . $this->where('cs_record_id', '=', $cs_record_id);
        $order_id = $this->execute($sql);
        if (!$order_id) {
            return false;
        }
        $order_id = $this->execute($sql)[0]['order_id'];
        if ($search_by == "member") {
            $member_id = $_SESSION['member_id'];
            $order_member_id = $orderList->getMemberIdByOrderId($order_id)[0]['member_id'];
            if ($member_id != $order_member_id) {
                return false;
            }
        }
        return $orderList->getOrderByOrderId($order_id);
    }

    public function searchOrderInfoByMemberId() {
        $orderList = new OrderList();

        $order_list = $orderList->getOrderById();
        if (!count($order_list)) {
            return false;
        }
        for ($i = 0; $i < count($order_list); $i++) {
            $order_list[$i] = $orderList->getOrderByOrderId($order_list[$i]['order_id']);
        }

        return $order_list;
    }

    public function jumpChatRoom($param) {
        $order_id = $param['order_id'];

        $sql = $this->select('cs_record', ['cs_record_id']) . $this->where('order_id', '=', $order_id);
        $cs_record_id = $this->execute($sql);
        if (!count($cs_record_id)) {
            $cs_record_id = $this->createCsRecord($order_id);
            $result = array(array('cs_record_id' => $cs_record_id));

            return $result;
        }
        return $cs_record_id;
    }
}
