<?php

namespace App\Classes\Order;

use App\Order;

class OrderHelper
{
    const DESC = 'DESC';
    const ASC = 'ASC';

    /**
     * Make order
     * @param array $data
     * @return Order
     */
    public static function make(array $data)
    {
        $order = new Order($data); // if product array
        $order->save();
        return $order;
    }

    /**
     * Change something in order
     * @param array $data
     */
    public static function change(array $data)
    {
        $order = Order::find($data['id']);
        $order->update($data);
    }

    /**
     * Get orders by status
     * @param string $status
     * @param string $order
     * @return mixed
     */
    public static function getOrdersByStatus($status = Order::STATUS_IN_PROCESS, $order = self::DESC)
    {
        $orders = Order::where('status', $status)
            ->orderBy('created_at', $order)
            ->get();
        return $orders;
    }

    /**
     * Get orders by user id
     * @param $id
     * @param string $order
     * @return mixed
     */
    public static function getOrdersByUserId($id, $order = self::DESC)
    {
        $orders = Order::where('user_id', $id)
            ->orderBy('created_at', $order)
            ->get();
        return $orders;
    }
}
