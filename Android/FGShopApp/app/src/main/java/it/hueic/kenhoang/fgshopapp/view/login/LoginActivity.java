package it.hueic.kenhoang.fgshopapp.view.login;

import android.content.Context;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;

import com.facebook.FacebookSdk;
import com.facebook.appevents.AppEventsLogger;
import com.google.android.material.tabs.TabLayout;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.viewpager.widget.ViewPager;
import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.adapter.ViewPagerAdapterLogin;
import uk.co.chrisjenx.calligraphy.CalligraphyConfig;
import uk.co.chrisjenx.calligraphy.CalligraphyContextWrapper;

public class LoginActivity extends AppCompatActivity {
    private static final String TAG = LoginActivity.class.getSimpleName();
    Toolbar toolbar;
    TabLayout tabLayout;
    ViewPager viewPager;

    //Need call this function after you init database firebase
    @Override
    protected void attachBaseContext(Context newBase) {
        super.attachBaseContext(CalligraphyContextWrapper.wrap(newBase));
    }
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        //Notes : add this code before setContentView
        CalligraphyConfig.initDefault(new CalligraphyConfig.Builder()
                .setDefaultFontPath("fonts/font_main.otf")
                .setFontAttrId(R.attr.fontPath)
                .build());
        setContentView(R.layout.activity_login);
        FacebookSdk.sdkInitialize(getApplicationContext());
        AppEventsLogger.activateApp(this);

        //InitView
        initView();
    }

    private void initView() {
        setUpToolbar();//Setup toolbar
        tabLayout = findViewById(R.id.tab);
        viewPager = findViewById(R.id.viewpager);

        ViewPagerAdapterLogin viewPagerAdapterLogin = new ViewPagerAdapterLogin(getSupportFragmentManager());
        viewPager.setAdapter(viewPagerAdapterLogin);
        viewPagerAdapterLogin.notifyDataSetChanged();

        tabLayout.setupWithViewPager(viewPager);
    }

    /**
     * Set up toolbar
     */
    private void setUpToolbar() {
        toolbar = findViewById(R.id.toolbar);
        toolbar.setTitleTextColor(Color.WHITE);
        toolbar.setNavigationIcon(R.drawable.ic_close_white_24dp);
        setSupportActionBar(toolbar);
        getSupportActionBar().setTitle("FGShop");
        getSupportActionBar().setHomeButtonEnabled(true);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }
}
