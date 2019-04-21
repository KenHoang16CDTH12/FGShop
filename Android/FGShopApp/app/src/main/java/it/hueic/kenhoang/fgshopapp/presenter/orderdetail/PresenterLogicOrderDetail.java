package it.hueic.kenhoang.fgshopapp.presenter.orderdetail;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.model.ModelDetail;
import it.hueic.kenhoang.fgshopapp.model.ModelOrder;
import it.hueic.kenhoang.fgshopapp.object.OrderDetail;
import it.hueic.kenhoang.fgshopapp.object.Product;
import it.hueic.kenhoang.fgshopapp.view.orderdetail.IViewOrderDetail;

public class PresenterLogicOrderDetail implements IPresenterOrderDetail {
    IViewOrderDetail view;
    ModelOrder model;

    public PresenterLogicOrderDetail(IViewOrderDetail view) {
        this.view = view;
        model = new ModelOrder();
    }

    @Override
    public void orderDetails(String token, int id_order) {
        List<OrderDetail> list = model.orderDetails(token, id_order);
        int total = 0;
        for (OrderDetail orderDetail: list) {
            ModelDetail modelDetail = new ModelDetail();
            Product product = modelDetail.findById(orderDetail.getId_product());
            int price = Integer.valueOf(product.getPrice()) * orderDetail.getQuantity();
            total += price;
        }
        view.orderDetails(list, total);
    }
}
