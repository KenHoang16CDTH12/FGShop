package it.hueic.kenhoang.fgshopapp.view.checkout;

import android.content.Context;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import com.valdesekamdem.library.mdtoast.MDToast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.helper.DatabaseHelper;
import it.hueic.kenhoang.fgshopapp.presenter.checkout.PresenterLogicCheckout;
import it.hueic.kenhoang.fgshopapp.utils.Utils;
import uk.co.chrisjenx.calligraphy.CalligraphyConfig;
import uk.co.chrisjenx.calligraphy.CalligraphyContextWrapper;

public class CheckoutActivity extends AppCompatActivity implements
        IViewCheckout {
    private static final String TAG = CheckoutActivity.class.getSimpleName();
    EditText edPhone, edDesc, edAddress;
    Button btnCheckout;
    PresenterLogicCheckout presenterLogicCheckout;
    //Need call this function after you init database
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
        setContentView(R.layout.activity_checkout);
        //InitView
        initView();
        //InitPresenter
        presenterLogicCheckout = new PresenterLogicCheckout(this, this);
        //InitEvent
        btnCheckout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String phone = edPhone.getText().toString();
                String address = edAddress.getText().toString();
                String desc = edDesc.getText().toString();
                String current_time = Utils.currentTime();
                if (!phone.trim().equals("") && !address.trim().equals(""))
                    presenterLogicCheckout.checkout(Common.CURRENT_USER.getToken(), Common.CURRENT_USER.getId(), Common.PLACED, phone, address, current_time, desc);
                else
                    if (phone.trim().equals("")) error("Please enter your phone");
                    if (address.trim().equals("")) error("Please enter your address");
            }
        });
    }

    private void initView() {
        setUpToolbar();
        edPhone = findViewById(R.id.edPhone);
        edDesc = findViewById(R.id.edDesc);
        btnCheckout = findViewById(R.id.btnCheckout);
        edAddress = findViewById(R.id.edAddress);
    }

    /**
     * Set up toolbar
     */
    private void setUpToolbar() {
        Toolbar toolbar = findViewById(R.id.toolbar);
        toolbar.setTitleTextColor(Color.WHITE);
        toolbar.setNavigationIcon(R.drawable.ic_close_white_24dp);
        setSupportActionBar(toolbar);
        getSupportActionBar().setTitle("FGShop Checkout");
        getSupportActionBar().setHomeButtonEnabled(true);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }

    @Override
    public void checkout(int status) {
        if (status == 200) {
            new DatabaseHelper(this).removeAllCart(Common.CURRENT_USER.getId());
            finish();
        }
    }

    @Override
    public void error(String message) {
        Utils.showToastShort(this, message, MDToast.TYPE_ERROR);
    }
}
