package it.hueic.kenhoang.fgshopapp.adapter;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;

import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.view.login.signin.FragmentSignIn;
import it.hueic.kenhoang.fgshopapp.view.login.signup.FragmentSignUp;

/**
 * Created by kenhoang on 26/04/2018.
 */

public class ViewPagerAdapterLogin extends FragmentPagerAdapter {
    public ViewPagerAdapterLogin(FragmentManager fm) {
        super(fm);
    }

    @Override
    public Fragment getItem(int position) {
        switch (position) {
            case 0:
                return new FragmentSignIn();
            case 1:
                return new FragmentSignUp();
        }
        return new FragmentSignIn();
    }

    @Override
    public int getCount() {
        return 2;
    }


    @Override
    public CharSequence getPageTitle(int position) {
        switch (position) {
            case 0:
                return Common.TITLE_FRAGMENT_LOGIN[0];
            case 1:
                return Common.TITLE_FRAGMENT_LOGIN[1];
        }
        return Common.TITLE_FRAGMENT_LOGIN[0];
    }


}
