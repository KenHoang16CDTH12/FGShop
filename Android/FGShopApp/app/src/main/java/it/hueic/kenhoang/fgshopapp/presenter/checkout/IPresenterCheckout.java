package it.hueic.kenhoang.fgshopapp.presenter.checkout;

import android.content.Context;

public interface IPresenterCheckout {
    void checkout(String token, int id_user, String status_order, String phone, String delivery_address, String order_date, String desc);
}
