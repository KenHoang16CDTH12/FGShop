package it.hueic.kenhoang.fgshopapp.presenter.detail;

import android.content.Context;

import it.hueic.kenhoang.fgshopapp.model.ModelCart;
import it.hueic.kenhoang.fgshopapp.model.ModelDetail;
import it.hueic.kenhoang.fgshopapp.view.detail.IViewDetail;

public class PresenterLogicDetail implements IPresenterDetail{
    IViewDetail view;
    ModelDetail model;

    public PresenterLogicDetail(IViewDetail view) {
        this.view = view;
        model = new ModelDetail();
    }

    @Override
    public void store(String token, int id_product, int id_user, String content, float stars, String time_rate) {
        int status = model.store(token, id_product, id_user, content, stars, time_rate);
        view.rated(status);
    }

    @Override
    public void countCart(Context context, int id_user) {
        ModelCart modelCart = new ModelCart(context);
        view.countCart(modelCart.countCart(id_user));
    }
}
