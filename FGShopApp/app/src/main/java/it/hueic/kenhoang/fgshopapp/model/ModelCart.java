package it.hueic.kenhoang.fgshopapp.model;

import android.content.Context;

import java.util.ArrayList;
import java.util.List;

import it.hueic.kenhoang.fgshopapp.helper.DatabaseHelper;
import it.hueic.kenhoang.fgshopapp.object.Cart;
import it.hueic.kenhoang.fgshopapp.object.OrderDetail;
import it.hueic.kenhoang.fgshopapp.object.Product;

public class ModelCart {
    Context context;

    public ModelCart(Context context) {
        this.context = context;
    }

    public boolean checkCart(int id_user, int id_product) {
        return new DatabaseHelper(context).checkCart(id_user, id_product);
    }

    public List<OrderDetail> allCart(int id_user) {
        return new DatabaseHelper(context).allCart(id_user);
    }

    public void saveCart(OrderDetail orderDetail) {
        new DatabaseHelper(context).saveCart(orderDetail);
    }

    public void saveCart(Cart cart) {
        new DatabaseHelper(context).saveCart(cart);
    }

    public void updateCart(OrderDetail orderDetail) {
        new DatabaseHelper(context).updateCart(orderDetail);
    }

    public void removeAllCart(int id_user) {
        new DatabaseHelper(context).removeAllCart(id_user);
    }

    public void removeCart(int id_user, int id_product) {
        new DatabaseHelper(context).removeCart(id_user, id_product);
    }

    public void increaseCart(int id_user, int id_product) {
        new DatabaseHelper(context).increaseCart(id_user, id_product);
    }

    public int countCart(int id_user) {
        return new DatabaseHelper(context).countCart(id_user);
    }

    public List<Cart> carts(int id_user) {
        List<OrderDetail> orderDetails = allCart(id_user);
        List<Cart> carts = new ArrayList<>();
        ModelDetail modelDetail = new ModelDetail();
        if (!orderDetails.isEmpty()) {
            for (OrderDetail orderDetail : orderDetails) {
                Cart cart = new Cart();
                cart.setId_product(orderDetail.getId_product());
                cart.setId_user(orderDetail.getId_user());
                cart.setQuantity(orderDetail.getQuantity());

                Product product = modelDetail.findById(orderDetail.getId_product());
                cart.setName(product.getName_product());
                cart.setPrice(product.getPrice());
                cart.setImage(product.getImage());
                cart.setTotal(orderDetail.getQuantity() * Integer.parseInt(product.getPrice()));

                carts.add(cart);
            }
        }
        return carts;
    }

}
