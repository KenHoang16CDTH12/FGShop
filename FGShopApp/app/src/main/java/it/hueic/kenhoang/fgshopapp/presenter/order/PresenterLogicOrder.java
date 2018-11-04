package it.hueic.kenhoang.fgshopapp.presenter.order;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.model.ModelOrder;
import it.hueic.kenhoang.fgshopapp.object.Order;
import it.hueic.kenhoang.fgshopapp.view.order.IViewOrder;

public class PresenterLogicOrder implements IPresenterOrder{
    IViewOrder view;
    ModelOrder model;

    public PresenterLogicOrder(IViewOrder view) {
        this.view = view;
        model = new ModelOrder();
    }

    @Override
    public void orders(String token, int id_user) {
        List<Order> orders = model.orders(token, id_user);
        view.orders(orders);
    }
}
