package it.hueic.kenhoang.fgshopapp.adapter;

import java.util.List;

import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.object.Banner;
import ss.com.bannerslider.adapters.SliderAdapter;
import ss.com.bannerslider.viewholder.ImageSlideViewHolder;

public class CustomSliderAdapter extends SliderAdapter {
    private List<Banner> bannerList;

    public CustomSliderAdapter(List<Banner> bannerList) {
        this.bannerList = bannerList;
    }

    @Override
    public int getItemCount() {
        return bannerList.size();
    }

    @Override
    public void onBindImageSlide(int position, ImageSlideViewHolder imageSlideViewHolder) {
        imageSlideViewHolder.bindImageSlide(Common.URL + bannerList.get(position).getImage());
    }
}
