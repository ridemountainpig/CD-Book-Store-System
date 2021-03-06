<?php

use model\Model;

require_once("commentList.php");
require_once("followList.php");
require_once("cart.php");

class Product extends Model {

    protected $table = "product";

    // 使用商品名稱模糊查詢商品名稱含有該字串的商品
    public function searchProductByName($param) {
        $product_name = $param["product_name"];
        $sql = $this->select($this->table) . $this->where('product_name', 'LIKE', "%{$product_name}%");
        $result = $this->execute($sql);
        $commentlist = new CommentList();
        foreach ($result as $r) {
            $arr[] = [0 => $r, 1 => $commentlist->getAvgStarById($r)];
        }
        return $arr;
    }

    public function timelysearchProductByName($param) {
        $product_name = $param["product_name"];
        $sql = $this->select($this->table) . $this->where('product_name', 'LIKE', "%{$product_name}%");
        return $this->execute($sql);
    }

    // 使用商品id查詢商品庫存
    public function searchProductNum($param) {
        $product_id = $param["product_id"];
        $sql = $this->select($this->table, ['product_number']) . $this->where('product_id', '=', $product_id);

        return $this->execute($sql);
    }

    // 傳入商品id更新商品庫存
    public function updateProductNum($param) {
        $product_id = $param["product_id"];
        $new_product_number = $param["new_product_number"];
        $sql = $this->update(['product_number' => $new_product_number]) . $this->where('product_id', '=', $product_id);
        return $this->execute($sql);
    }

    // 查詢某商品id對應的價錢
    public function searchPriceById($product_id) {
        $sql = $this->select($this->table, ['product_price']) . $this->where('product_id', '=', $product_id);

        return $this->execute($sql);
    }

    public function createProduct($param) {
        $product_name = $param['product_name'];
        $product_description = $param['product_description'];
        $product_image = $param['product_image'];
        $product_price = $param['product_price'];
        $product_number = $param['product_number'];
        $product_author = $param['product_author'];
        $color_theme = $param['color_theme'];
        $sql = $this->insert(['color_theme' => $color_theme, 'product_author' => $product_author, 'product_name' => $product_name, 'product_description' => $product_description, 'product_image' => $product_image, 'product_price' => $product_price, 'product_number' => $product_number]);

        return $this->execute($sql);
    }

    // 在訂單建立時減少商品庫存
    public function reduceProductNum($param) {
        $count_num = $param['count_num'];
        $product_id = $param['product_id'];
        $current_product_number = $this->searchProductNum($param);
        $new_product_number = $current_product_number[0]['product_number'] - $count_num;
        $param['new_product_number'] = $new_product_number;
        return $this->updateProductNum($param);
    }

    //透過商品id查詢商品資料
    public function searchProductById($param) {
        $commentList = new CommentList();

        $product_id = $param['product_id'];
        $sql = $this->select($this->table) . $this->where('product_id', '=', $product_id);
        $result = $this->execute($sql);
        if (!$result) {
            return false;
        }
        $result[0]['avg_star'] = $commentList->getAvgStarById($param);

        return $result;
    }

    public function getRandTenProduct() {
        $commentList = new CommentList();
        $follow_list = new FollowList();
        $cart = new Cart();

        $sql = $this->select($this->table) . " ORDER BY RAND() LIMIT 10";
        $result = $this->execute($sql);
        for ($i = 0; $i < count($result); $i++) {
            $param = array('product_id' => $result[$i]['product_id']);
            $result[$i]['avg_star'] = $commentList->getAvgStarById($param);
            if (isset($_SESSION['member_id'])) {
                $result[$i]['member_data']['isFollow'] = $follow_list->isFollow($param);
                $result[$i]['member_data']['isCart'] = $cart->isCart($param);
            }
        }

        return $result;
    }

    public function deleteProduct($param) {
        $product_id = $param['product_id'];
        $sql = $this->delete() . $this->where('product_id', '=', $product_id);
        $this->execute($sql);
    }
    public function updateProduct($param) {
        $product_name = $param['product_name'];
        $product_description = $param['product_description'];
        $product_image = $param['product_image'];
        $product_price = $param['product_price'];
        $product_number = $param['product_number'];
        $product_author = $param['product_author'];
        $color_theme = $param['color_theme'];
        $product_id = $param['product_id'];
        if ($product_image == "/CD-Book-Store-System/view/src/image/book/") {
            $sql = $this->update(['color_theme' => $color_theme, 'product_author' => $product_author, 'product_name' => $product_name, 'product_description' => $product_description, 'product_price' => $product_price, 'product_number' => $product_number]) . $this->where('product_id', '=', $product_id);
        } else {
            $sql = $this->update(['color_theme' => $color_theme, 'product_author' => $product_author, 'product_name' => $product_name, 'product_description' => $product_description, 'product_image' => $product_image, 'product_price' => $product_price, 'product_number' => $product_number]) . $this->where('product_id', '=', $product_id);
        }
        return $this->execute($sql);
    }
}
