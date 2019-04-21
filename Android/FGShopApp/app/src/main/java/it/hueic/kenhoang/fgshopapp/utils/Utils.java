package it.hueic.kenhoang.fgshopapp.utils;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.content.pm.Signature;
import android.util.Base64;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.ProgressBar;

import com.google.android.material.snackbar.Snackbar;
import com.squareup.picasso.Picasso;
import com.squareup.picasso.Target;
import com.valdesekamdem.library.mdtoast.MDToast;

import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.helper.ImageViewTarget;
import it.hueic.kenhoang.fgshopapp.view.cart.CartActivity;
import it.hueic.kenhoang.fgshopapp.view.favorite.FavoriteActivity;
import it.hueic.kenhoang.fgshopapp.view.login.LoginActivity;
import it.hueic.kenhoang.fgshopapp.view.order.OrderActivity;

public class Utils {
    /** Show MDToast **/
    public static void showToastShort(Context context, String msg, int type) {
        MDToast.makeText(context, msg, MDToast.LENGTH_SHORT, type).show();
    }

    /** Show MDToast **/
    public static void showToastLong(Context context, String msg, int type) {
        MDToast.makeText(context, msg, MDToast.LENGTH_LONG, type).show();
    }

    /** Show snack bar **/
    public static void showSnackBarShort(View view, String msg) {
        Snackbar.make(view, msg, Snackbar.LENGTH_SHORT).show();
    }

    /** Load image with Picasso **/
    public static void loadImage(Context context, String path, final ImageView img, final ProgressBar progressBar) {
        Target target = new ImageViewTarget(img, progressBar);

        Picasso.get()
                .load(Common.URL + path)
                .into(target);
    }

    /** Show snack bar **/
    public static void showSnackBarLong(View view, String msg) {
        Snackbar.make(view, msg, Snackbar.LENGTH_LONG).show();
    }

    /** Key Hash **/
    public static void hashKeyFacebook(Activity activity) {
        // Add code to print out the key hash
        try {
            PackageInfo info = activity.getPackageManager().getPackageInfo(
                    "it.hueic.kenhoang.fgshopapp",
                    PackageManager.GET_SIGNATURES);
            for (Signature signature : info.signatures) {
                MessageDigest md = MessageDigest.getInstance("SHA");
                md.update(signature.toByteArray());
                Log.d("KeyHash:", Base64.encodeToString(md.digest(), Base64.DEFAULT));
            }
        } catch (PackageManager.NameNotFoundException e) {

        } catch (NoSuchAlgorithmException e) {

        }
    }

    /** Check User Login **/
    public static boolean isLogin() {
        if (Common.CURRENT_USER != null) return true;
        return false;
    }

    /** Open Activity Login **/
    public static void openLogin(Activity activity) {
        Intent loginIntent = new Intent(activity, LoginActivity.class);
        activity.startActivity(loginIntent);
    }

    /** Open Activity Cart **/
    public static void openCart(Activity activity) {
        if (isLogin()) {
            Intent cartActivity = new Intent(activity, CartActivity.class);
            activity.startActivity(cartActivity);
        } else {
            openLogin(activity);
        }
    }

    /** Open Activity Order **/
    public static void openOrder(Activity activity) {
        if (isLogin()) {
            Intent orderIntent = new Intent(activity, OrderActivity.class);
            activity.startActivity(orderIntent);
        } else {
            openLogin(activity);
        }
    }

    /** Open Activity Favorite **/
    public static void openFavorite(Activity activity) {
        if (isLogin()) {
            Intent favoriteIntent = new Intent(activity, FavoriteActivity.class);
            activity.startActivity(favoriteIntent);
        } else {
            openLogin(activity);
        }
    }

    /** Convert time same facebook **/
    public static String convertTime(String time_rate) {
        String timeStamp = "";
        Calendar calendar = Calendar.getInstance();
        long tsRate = Long.parseLong(time_rate)/1000;
        long tsReply = calendar.getTimeInMillis()/1000;
        long distance = tsReply - tsRate;
        //Log.d("DISTANCE", String.valueOf(distance));
        calendar.setTimeInMillis(Long.parseLong(time_rate));
        int mYear   = calendar.get(Calendar.YEAR);
        int mMonth  = calendar.get(Calendar.MONTH);
        int mDay    = calendar.get(Calendar.DAY_OF_MONTH);
        int mHour   = calendar.get(Calendar.HOUR_OF_DAY);
        int mMinute = calendar.get(Calendar.MINUTE);
        String time = (mHour < 10 ? "0" + mHour : mHour) +
                ":" +
                (mMinute < 10 ? "0" + mMinute : mMinute);
        String timeFull = (mDay < 10 ? "0" + mDay : mDay) +
                "/" +
                (mMonth < 10 ? "0" + (mMonth + 1) : (mMonth + 1)) +
                "/" +
                mYear +
                " " +
                (mHour < 10 ? "0" + mHour : mHour) +
                ":" +
                (mMinute < 10 ? "0" + mMinute : mMinute);
        timeStamp  = parseTime(distance, time, timeFull);

        return timeStamp;
    }

    /**
     * Parse Time same facebook
     * @param distance
     * @param time
     * @param timeFull
     * @return
     */
    public static String parseTime(long distance, String time, String timeFull) {
        String result = "";
        if (distance < 60) result = (distance == 1) ? distance + " second ago." : distance + " seconds ago.";
        else if (distance >= 60 && distance < 3600) {
            int minute = Math.round(distance/60);
            result = (minute == 1) ? minute + " minute ago." : minute + " minutes ago.";
        }
        else if (distance >= 3600 && distance < 86400) {
            int hour = Math.round(distance/3600);
            result = (hour == 1) ? hour + " hour ago." : hour + " hours ago.";
        }
        else if (Math.round(distance/86400) == 1) {
            result = "Yesterday at " + time;
        }
        else {
            result = timeFull;
        }

        return result;
    }

    /** Current Time **/
    public static String currentTime() {
        Date c = Calendar.getInstance().getTime();
        SimpleDateFormat df = new SimpleDateFormat("dd/MM/yyyy");
        String formattedDate = df.format(c);
        return formattedDate;
    }
}
