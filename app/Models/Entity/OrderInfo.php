<?php
namespace App\Models\Entity;

use Swoft\Db\Model;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Types;

/**
 * @Entity()
 * @Table(name="order_info")
 * @uses      OrderInfo
 */
class OrderInfo extends Model
{
    /**
     * @var int $orderId 订单表自增主键
     * @Id()
     * @Column(name="order_id", type="integer")
     */
    private $orderId;

    /**
     * @var string $orderNo 商户内部订单号
     * @Column(name="order_no", type="string", length=50)
     * @Required()
     */
    private $orderNo;

    /**
     * @var int $orderType 订单类型|1:商城订单,默认|2:虚拟订单(充值)
     * @Column(name="order_type", type="tinyint", default=1)
     */
    private $orderType;

    /**
     * @var int $paymentId 支付方式id|1:支付宝|2:微信|3:余额
     * @Column(name="payment_id", type="integer")
     * @Required()
     */
    private $paymentId;

    /**
     * @var string $paymentNumber 商家内部支付单号
     * @Column(name="payment_number", type="string", length=20)
     * @Required()
     */
    private $paymentNumber;

    /**
     * @var string $paymentOuterNumber 第三方支付单号
     * @Column(name="payment_outer_number", type="string", length=20)
     */
    private $paymentOuterNumber;

    /**
     * @var int $buyUserId 购买用户id
     * @Column(name="buy_user_id", type="integer")
     * @Required()
     */
    private $buyUserId;

    /**
     * @var int $orderStatus 订单状态|1:等待买家付款|2:已付款|3:卖家配货中|4:已发货(有物流单号)|5:发货完成(已签收)|6:交易完成(用户手动确定或者脚本定时执行)|7:订单取消
     * @Column(name="order_status", type="tinyint", default=0)
     */
    private $orderStatus;

    /**
     * @var int $refundStatus 退款状态
     * @Column(name="refund_status", type="tinyint", default=0)
     */
    private $refundStatus;

    /**
     * @var int $shopId 卖家店铺id
     * @Column(name="shop_id", type="integer")
     * @Required()
     */
    private $shopId;

    /**
     * @var string $shopName 卖家店铺名称
     * @Column(name="shop_name", type="string", length=50)
     * @Required()
     */
    private $shopName;

    /**
     * @var string $createTime 订单创建时间
     * @Column(name="create_time", type="timestamp")
     * @Required()
     */
    private $createTime;

    /**
     * @var string $payTime 订单支付时间
     * @Column(name="pay_time", type="timestamp")
     */
    private $payTime;

    /**
     * @var float $orderAmount 订单总金额
     * @Column(name="order_amount", type="decimal", default=0)
     */
    private $orderAmount;

    /**
     * @var float $orderDiscountFee 订单折扣金额
     * @Column(name="order_discount_fee", type="decimal", default=0)
     */
    private $orderDiscountFee;

    /**
     * @var float $orderPayAmount 订单实付金额
     * @Column(name="order_pay_amount", type="decimal", default=0)
     */
    private $orderPayAmount;

    /**
     * @var float $shippingFee 运费金额
     * @Column(name="shipping_fee", type="decimal", default=0)
     */
    private $shippingFee;

    /**
     * @var int $redpacketId 红包主键id
     * @Column(name="redpacket_id", type="integer", default=0)
     */
    private $redpacketId;

    /**
     * @var float $redpacketAmount 红包优惠金额
     * @Column(name="redpacket_amount", type="decimal", default=0)
     */
    private $redpacketAmount;

    /**
     * @var int $orderFrom 订单来源|1:pc|2:mobile|3:xcx|4:app
     * @Column(name="order_from", type="tinyint")
     * @Required()
     */
    private $orderFrom;

    /**
     * 订单表自增主键
     * @param int $value
     * @return $this
     */
    public function setOrderId(int $value)
    {
        $this->orderId = $value;

        return $this;
    }

    /**
     * 商户内部订单号
     * @param string $value
     * @return $this
     */
    public function setOrderNo(string $value): self
    {
        $this->orderNo = $value;

        return $this;
    }

    /**
     * 订单类型|1:商城订单,默认|2:虚拟订单(充值)
     * @param int $value
     * @return $this
     */
    public function setOrderType(int $value): self
    {
        $this->orderType = $value;

        return $this;
    }

    /**
     * 支付方式id|1:支付宝|2:微信|3:余额
     * @param int $value
     * @return $this
     */
    public function setPaymentId(int $value): self
    {
        $this->paymentId = $value;

        return $this;
    }

    /**
     * 商家内部支付单号
     * @param string $value
     * @return $this
     */
    public function setPaymentNumber(string $value): self
    {
        $this->paymentNumber = $value;

        return $this;
    }

    /**
     * 第三方支付单号
     * @param string $value
     * @return $this
     */
    public function setPaymentOuterNumber(string $value): self
    {
        $this->paymentOuterNumber = $value;

        return $this;
    }

    /**
     * 购买用户id
     * @param int $value
     * @return $this
     */
    public function setBuyUserId(int $value): self
    {
        $this->buyUserId = $value;

        return $this;
    }

    /**
     * 订单状态|1:等待买家付款|2:已付款|3:卖家配货中|4:已发货(有物流单号)|5:发货完成(已签收)|6:交易完成(用户手动确定或者脚本定时执行)|7:订单取消
     * @param int $value
     * @return $this
     */
    public function setOrderStatus(int $value): self
    {
        $this->orderStatus = $value;

        return $this;
    }

    /**
     * 退款状态
     * @param int $value
     * @return $this
     */
    public function setRefundStatus(int $value): self
    {
        $this->refundStatus = $value;

        return $this;
    }

    /**
     * 卖家店铺id
     * @param int $value
     * @return $this
     */
    public function setShopId(int $value): self
    {
        $this->shopId = $value;

        return $this;
    }

    /**
     * 卖家店铺名称
     * @param string $value
     * @return $this
     */
    public function setShopName(string $value): self
    {
        $this->shopName = $value;

        return $this;
    }

    /**
     * 订单创建时间
     * @param string $value
     * @return $this
     */
    public function setCreateTime(string $value): self
    {
        $this->createTime = $value;

        return $this;
    }

    /**
     * 订单支付时间
     * @param string $value
     * @return $this
     */
    public function setPayTime(string $value): self
    {
        $this->payTime = $value;

        return $this;
    }

    /**
     * 订单总金额
     * @param float $value
     * @return $this
     */
    public function setOrderAmount(float $value): self
    {
        $this->orderAmount = $value;

        return $this;
    }

    /**
     * 订单折扣金额
     * @param float $value
     * @return $this
     */
    public function setOrderDiscountFee(float $value): self
    {
        $this->orderDiscountFee = $value;

        return $this;
    }

    /**
     * 订单实付金额
     * @param float $value
     * @return $this
     */
    public function setOrderPayAmount(float $value): self
    {
        $this->orderPayAmount = $value;

        return $this;
    }

    /**
     * 运费金额
     * @param float $value
     * @return $this
     */
    public function setShippingFee(float $value): self
    {
        $this->shippingFee = $value;

        return $this;
    }

    /**
     * 红包主键id
     * @param int $value
     * @return $this
     */
    public function setRedpacketId(int $value): self
    {
        $this->redpacketId = $value;

        return $this;
    }

    /**
     * 红包优惠金额
     * @param float $value
     * @return $this
     */
    public function setRedpacketAmount(float $value): self
    {
        $this->redpacketAmount = $value;

        return $this;
    }

    /**
     * 订单来源|1:pc|2:mobile|3:xcx|4:app
     * @param int $value
     * @return $this
     */
    public function setOrderFrom(int $value): self
    {
        $this->orderFrom = $value;

        return $this;
    }

    /**
     * 订单表自增主键
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * 商户内部订单号
     * @return string
     */
    public function getOrderNo()
    {
        return $this->orderNo;
    }

    /**
     * 订单类型|1:商城订单,默认|2:虚拟订单(充值)
     * @return mixed
     */
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * 支付方式id|1:支付宝|2:微信|3:余额
     * @return int
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * 商家内部支付单号
     * @return string
     */
    public function getPaymentNumber()
    {
        return $this->paymentNumber;
    }

    /**
     * 第三方支付单号
     * @return string
     */
    public function getPaymentOuterNumber()
    {
        return $this->paymentOuterNumber;
    }

    /**
     * 购买用户id
     * @return int
     */
    public function getBuyUserId()
    {
        return $this->buyUserId;
    }

    /**
     * 订单状态|1:等待买家付款|2:已付款|3:卖家配货中|4:已发货(有物流单号)|5:发货完成(已签收)|6:交易完成(用户手动确定或者脚本定时执行)|7:订单取消
     * @return int
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * 退款状态
     * @return int
     */
    public function getRefundStatus()
    {
        return $this->refundStatus;
    }

    /**
     * 卖家店铺id
     * @return int
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * 卖家店铺名称
     * @return string
     */
    public function getShopName()
    {
        return $this->shopName;
    }

    /**
     * 订单创建时间
     * @return string
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * 订单支付时间
     * @return string
     */
    public function getPayTime()
    {
        return $this->payTime;
    }

    /**
     * 订单总金额
     * @return mixed
     */
    public function getOrderAmount()
    {
        return $this->orderAmount;
    }

    /**
     * 订单折扣金额
     * @return mixed
     */
    public function getOrderDiscountFee()
    {
        return $this->orderDiscountFee;
    }

    /**
     * 订单实付金额
     * @return mixed
     */
    public function getOrderPayAmount()
    {
        return $this->orderPayAmount;
    }

    /**
     * 运费金额
     * @return mixed
     */
    public function getShippingFee()
    {
        return $this->shippingFee;
    }

    /**
     * 红包主键id
     * @return int
     */
    public function getRedpacketId()
    {
        return $this->redpacketId;
    }

    /**
     * 红包优惠金额
     * @return mixed
     */
    public function getRedpacketAmount()
    {
        return $this->redpacketAmount;
    }

    /**
     * 订单来源|1:pc|2:mobile|3:xcx|4:app
     * @return int
     */
    public function getOrderFrom()
    {
        return $this->orderFrom;
    }

}
