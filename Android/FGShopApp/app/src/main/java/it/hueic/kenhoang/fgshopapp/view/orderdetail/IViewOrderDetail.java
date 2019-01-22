package it.hueic.kenhoang.fgshopapp.view.orderdetail;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.object.OrderDetail;

public interface IViewOrderDetail {
    void orderDetails(List<OrderDetail> orderDetails, int total);
}
