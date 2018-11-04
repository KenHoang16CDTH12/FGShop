package it.hueic.kenhoang.fgshopapp.view.cart;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.object.Cart;

public interface IViewCart {
    void carts(List<Cart> carts);
    void total(int total);
    void error(String msg);
}
