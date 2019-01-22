package it.hueic.kenhoang.fgshopapp.presenter.favorite;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.model.ModelFavorite;
import it.hueic.kenhoang.fgshopapp.object.Product;
import it.hueic.kenhoang.fgshopapp.view.favorite.IViewFavorite;

public class PresenterLogicFavorite implements IPresenterFavorite {
    IViewFavorite view;
    ModelFavorite model;

    public PresenterLogicFavorite(IViewFavorite view) {
        this.view = view;
        model = new ModelFavorite();
    }

    @Override
    public void favorites(String token, int id_user) {
        List<Product> products = model.favorites(token, id_user);
        view.favorites(products);
    }
}
