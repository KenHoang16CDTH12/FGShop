package it.hueic.kenhoang.fgshopapp.presenter.home;

import android.content.Context;

public interface IPresenterHome {
    void loadBanners();
    void loadGroupProductTypes();
    void logout(String token);
    void countCart(Context context, int id_user);
}
