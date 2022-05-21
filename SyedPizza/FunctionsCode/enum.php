<?php
abstract class enum {
  
    // Enumeration constructor
    final public function __construct($value) {
        echo '<script>alert("In Const")</script>';
        $this->value = $value;
    }
  
    // String representation
    final public function __toString() {
        echo '<script>alert("Return")</script>';
        return $this->value;
    }
}
class PaymentMethod extends enum{
    const CashOnDelievery = 0;
    const OnlinePayment = 1;
}
class OrderStatus extends enum{
    const OrderPlace = 0;
    const OrderConfirmed = 1;
    const PreparingOrder = 2;
    const OnTheWay = 3;
    const OrderDelievered = 4;
    const OrderDenied = 5;
    const OrderCancelled = 6;
}

?>