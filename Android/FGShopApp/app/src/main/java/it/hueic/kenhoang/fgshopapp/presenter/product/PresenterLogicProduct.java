package it.hueic.kenhoang.fgshopapp.presenter.product;

import android.view.View;
import android.widget.ProgressBar;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.model.ModelProduct;
import it.hueic.kenhoang.fgshopapp.object.Product;
import it.hueic.kenhoang.fgshopapp.object.ProductType;
import it.hueic.kenhoang.fgshopapp.view.product.IViewProduct;

public class PresenterLogicProduct implements IPresenterProduct {
    IViewProduct view;
    ModelProduct model;

    public PresenterLogicProduct(IViewProduct view) {
        this.view = view;
        model = new ModelProduct();
    }

    @Override
    public void menus(int id_group) {
        List<ProductType> productTypes = model.productTypes(id_group);
        if (productTypes != null && !productTypes.isEmpty())
            view.menus(productTypes);
    }

    @Override
    public void products(int id_product_type) {
        List<Product> products = model.products(id_product_type, 0);
        if (products != null && !products.isEmpty())
            view.products(products);
        else
            view.emptyProduct();
    }

    @Override
    public List<Product> loadMoreProducts(int id_product_type, int sumItem, ProgressBar progress) {
        progress.setVisibility(View.VISIBLE);
        List<Product> products = model.products(id_product_type, sumItem);
        if (!products.isEmpty()) progress.setVisibility(View.GONE);
        return products;
    }
}
