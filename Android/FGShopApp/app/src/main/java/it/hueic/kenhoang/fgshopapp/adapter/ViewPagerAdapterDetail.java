package it.hueic.kenhoang.fgshopapp.adapter;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;

import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.view.detail.detail.FragmentDetail;
import it.hueic.kenhoang.fgshopapp.view.detail.overview.FragmentOverview;
import it.hueic.kenhoang.fgshopapp.view.detail.rating.FragmentRating;

public class ViewPagerAdapterDetail extends FragmentPagerAdapter {
    public ViewPagerAdapterDetail(FragmentManager fm) {
        super(fm);
    }

    @Override
    public Fragment getItem(int position) {
        switch (position) {
            case 0:
                return new FragmentOverview();
            case 1:
                return new FragmentRating();
            case 2:
                return new FragmentDetail();
        }
        return new FragmentOverview();
    }

    @Override
    public int getCount() {
        return 3;
    }


    @Override
    public CharSequence getPageTitle(int position) {
        switch (position) {
            case 0:
                return Common.TITLE_FRAGMENT_DETAIL[0];
            case 1:
                return Common.TITLE_FRAGMENT_DETAIL[1];
            case 2:
                return Common.TITLE_FRAGMENT_DETAIL[2];
        }
        return Common.TITLE_FRAGMENT_DETAIL[0];
    }


}
