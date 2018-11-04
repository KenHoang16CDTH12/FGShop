package it.hueic.kenhoang.fgshopapp.presenter.cart;

import it.hueic.kenhoang.fgshopapp.object.Cart;
import it.hueic.kenhoang.fgshopapp.object.OrderDetail;

public interface IPresenterCart {
    void save(Cart cart);
    void save(OrderDetail orderDetail);
    void removeIndex(int id_user, int id_product);
    void carts(int id_user);
    void total(int id_user);
}
