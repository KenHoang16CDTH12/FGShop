package it.hueic.kenhoang.fgshopapp.view.home;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.object.Banner;
import it.hueic.kenhoang.fgshopapp.object.GroupProductType;

public interface IViewHome {
    void showBanners(List<Banner> banners);
    void showGroupProductTypes(List<GroupProductType> groupProductTypes);
    void showError();
    void logout(int status);
    void countCart(int count);
}
