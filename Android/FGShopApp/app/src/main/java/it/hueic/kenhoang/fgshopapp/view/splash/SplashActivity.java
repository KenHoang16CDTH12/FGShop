package it.hueic.kenhoang.fgshopapp.view.splash;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.WindowManager;

import androidx.appcompat.app.AppCompatActivity;
import io.paperdb.Paper;
import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.view.home.HomeActivity;
import it.hueic.kenhoang.fgshopapp.view.login.LoginActivity;
import uk.co.chrisjenx.calligraphy.CalligraphyConfig;
import uk.co.chrisjenx.calligraphy.CalligraphyContextWrapper;

public class SplashActivity extends AppCompatActivity {
    private static final String TAG = SplashActivity.class.getSimpleName();
    private static final int TIME_SLEEP = 3000;

    @Override
    protected void attachBaseContext(Context newBase) {
        super.attachBaseContext(CalligraphyContextWrapper.wrap(newBase));
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        //Notes : add this code before setContentView
        CalligraphyConfig.initDefault(new CalligraphyConfig.Builder()
                .setDefaultFontPath("fonts/font_main.otf")
                .setFontAttrId(R.attr.fontPath)
                .build());
        setContentView(R.layout.activity_splash);
        //Init Paper
        Paper.init(this);
        final Thread thread = new Thread(new Runnable() {
            @Override
            public void run() {
                try {
                    Thread.sleep(TIME_SLEEP);
                } catch (Exception ex) {

                } finally {
                    String email = Paper.book().read(Common.USERNAME_KEY);
                    String password = Paper.book().read(Common.PASSWORD_KEY);
                    if (email != null & password != null) {
                        if (!email.isEmpty() && !password.isEmpty()) {
                            Intent loginIntent = new Intent(SplashActivity.this, LoginActivity.class);
                            startActivity(loginIntent);
                            finish();
                        }
                    } else {
                        Intent homeIntent = new Intent(SplashActivity.this, HomeActivity.class);
                        startActivity(homeIntent);
                        finish();
                    }
                }
            }
        });

        thread.start();
    }
}
