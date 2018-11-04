package it.hueic.kenhoang.fgshopapp.presenter.detail.overview;

import it.hueic.kenhoang.fgshopapp.model.ModelDetail;
import it.hueic.kenhoang.fgshopapp.view.detail.overview.IFragmentOverview;

public class PresenterLogicOverview implements IPresenterOverview {
    IFragmentOverview view;
    ModelDetail model;

    public PresenterLogicOverview(IFragmentOverview view) {
        this.view = view;
        model = new ModelDetail();
    }

    @Override
    public void isFavorite(String token, int id_product, int id_user) {
        String message = model.checkFavorite(token, id_product, id_user);
        view.isFavorite(message);
    }

    @Override
    public void doFavorite(String token, int id_product, int id_user) {
        String message = model.favorite(token, id_product, id_user);
        view.isFavorite(message);
    }


}
