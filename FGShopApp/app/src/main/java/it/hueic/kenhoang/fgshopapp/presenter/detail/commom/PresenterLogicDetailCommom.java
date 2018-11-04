package it.hueic.kenhoang.fgshopapp.presenter.detail.commom;

import it.hueic.kenhoang.fgshopapp.model.ModelDetail;
import it.hueic.kenhoang.fgshopapp.object.Product;
import it.hueic.kenhoang.fgshopapp.view.detail.commom.IViewDetailCommom;

public class PresenterLogicDetailCommom implements IPresenterDetailCommom {
    IViewDetailCommom view;
    ModelDetail model;

    public PresenterLogicDetailCommom(IViewDetailCommom view) {
        this.view = view;
        model = new ModelDetail();
    }

    @Override
    public void fillData(int id_product) {
        Product product = model.findById(id_product);
        if (product != null) view.fillData(product);
        else view.showError("Error 404");
    }
}
