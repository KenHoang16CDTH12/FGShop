package it.hueic.kenhoang.fgshopapp.presenter.checkout;

import android.content.Context;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.helper.DatabaseHelper;
import it.hueic.kenhoang.fgshopapp.model.ModelCheckout;
import it.hueic.kenhoang.fgshopapp.object.OrderDetail;
import it.hueic.kenhoang.fgshopapp.view.checkout.IViewCheckout;

public class PresenterLogicCheckout implements IPresenterCheckout{
    IViewCheckout view;
    ModelCheckout model;
    Context context;

    public PresenterLogicCheckout(IViewCheckout view, Context context) {
        this.view = view;
        this.context = context;
        model = new ModelCheckout();
    }

    @Override
    public void checkout(String token, int id_user, String status_order, String phone, String delivery_address, String order_date, String desc) {
        int id_order = model.request(token, id_user, status_order, phone, delivery_address, order_date, desc);
        if (id_order != 0) {
            List<OrderDetail> orders = new DatabaseHelper(context).allCart(id_user);
            for (OrderDetail order: orders) {
                int status = model.store(token, id_order, order.getId_product(), order.getQuantity());
                if (status != 200) break;
            }
            view.checkout(200);
        } else {
            view.error("Unauthorized");
        }
    }
}
