package it.hueic.kenhoang.fgshopapp.view.login.signin;

import android.app.AlertDialog;
import android.content.Intent;
import android.os.Bundle;

import androidx.annotation.Nullable;
import com.google.android.material.textfield.TextInputLayout;
import androidx.fragment.app.Fragment;
import android.util.Patterns;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import com.facebook.CallbackManager;
import com.facebook.FacebookSdk;
import com.facebook.appevents.AppEventsLogger;
import com.facebook.login.LoginManager;
import com.google.android.gms.auth.api.signin.GoogleSignIn;
import com.google.android.gms.auth.api.signin.GoogleSignInAccount;
import com.google.android.gms.auth.api.signin.GoogleSignInClient;
import com.google.android.gms.tasks.Task;
import com.valdesekamdem.library.mdtoast.MDToast;


import java.util.Arrays;

import dmax.dialog.SpotsDialog;
import io.paperdb.Paper;
import it.hueic.kenhoang.fgshopapp.R;
import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.custom.EmailEditTextCustom;
import it.hueic.kenhoang.fgshopapp.custom.PasswordEditTextCustom;
import it.hueic.kenhoang.fgshopapp.helper.FacebookHelper;
import it.hueic.kenhoang.fgshopapp.helper.GoogleHelper;
import it.hueic.kenhoang.fgshopapp.object.User;
import it.hueic.kenhoang.fgshopapp.presenter.login.PresenterLogicLogin;
import it.hueic.kenhoang.fgshopapp.utils.Utils;
import it.hueic.kenhoang.fgshopapp.view.home.HomeActivity;
import it.hueic.kenhoang.fgshopapp.view.login.IViewLogin;

/**
 * Created by kenhoang on 02/03/2018.
 */

public class FragmentSignIn extends Fragment implements View.OnClickListener,
        View.OnFocusChangeListener,
        IViewLogin {
    private static final String TAG = FragmentSignIn.class.getSimpleName();
    private static final int RC_SIGN_IN = 9001;
    Button btnFacebook, btnGoogle, btnLogin;
    TextInputLayout inputEmail, inputPass;
    EmailEditTextCustom edEmail;
    PasswordEditTextCustom edPass;
    CallbackManager callbackManager;
    private GoogleSignInClient mGoogleSignInClient;
    PresenterLogicLogin presenterLogicLogin;
    //Alert Dialog
    AlertDialog waitingDialog;

    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_sign_in, container, false);
        //Init Facebook
        FacebookSdk.sdkInitialize(getContext().getApplicationContext());
        AppEventsLogger.activateApp(getContext());
        //Init Google
        mGoogleSignInClient = GoogleHelper.getGoogleSignInClient(getContext());
        //Init Paper
        Paper.init(getContext());
        //Init Presenter
        presenterLogicLogin = new PresenterLogicLogin(this);
        //InitView
        initView(view);
        //Facebook
        callbackManager = CallbackManager.Factory.create();
        FacebookHelper.validate(callbackManager, presenterLogicLogin);
        //InitEvent
        initEvent();
        //Auto
        autoLogin();
        return view;
    }

    private void autoLogin() {
        String email = Paper.book().read(Common.USERNAME_KEY);
        String password = Paper.book().read(Common.PASSWORD_KEY);
        if (email != null & password != null) {
            if (!email.isEmpty() && !password.isEmpty()) handleLoginWithText(email, password);
        }
    }

    private void initEvent() {
        btnFacebook.setOnClickListener(this);
        btnGoogle.setOnClickListener(this);
        btnLogin.setOnClickListener(this);

        edEmail.setOnFocusChangeListener(this);
    }

    private void initView(View view) {
        btnFacebook = view.findViewById(R.id.btnFacebook);
        btnGoogle = view.findViewById(R.id.btnGoogle);
        btnLogin = view.findViewById(R.id.btnLogin);

        inputEmail = view.findViewById(R.id.inputEmail);
        inputPass = view.findViewById(R.id.inputPass);

        edEmail = view.findViewById(R.id.edEmail);
        edPass = view.findViewById(R.id.edPassword);
    }

    @Override
    public void onClick(View view) {
        int id = view.getId();
        switch (id) {
            case R.id.btnFacebook:
                LoginManager.getInstance().logInWithReadPermissions(this, Arrays.asList("public_profile", "email"));
                break;
            case R.id.btnGoogle:
                signInGoogle();
                break;
            case R.id.btnLogin:
                String email = edEmail.getText().toString();
                String pass = edPass.getText().toString();
                handleLoginWithText(email, pass);
                break;
        }
    }

    private void handleLoginWithText(final String email, final String pass) {
        showDialog();
        if (!email.trim().equals("") && !pass.trim().equals(""))
            presenterLogicLogin.validateLogin(email, pass);
        else
            Utils.showSnackBarShort(getView().findViewById(R.id.layoutMainSignIn), "Please fill full information");

    }

    private void showDialog() {
        waitingDialog = new SpotsDialog(getActivity());

        waitingDialog.setCancelable(false);
        waitingDialog.show();
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        callbackManager.onActivityResult(requestCode, resultCode, data);
        // Result returned from launching the Intent from GoogleSignInClient.getSignInIntent(...);
        if (requestCode == RC_SIGN_IN) {
            // The Task returned from this call is always completed, no need to attach
            // a listener.
            Task<GoogleSignInAccount> task = GoogleSignIn.getSignedInAccountFromIntent(data);
            GoogleHelper.handleSignInResult(task, getActivity(), presenterLogicLogin);
        }
    }

    private void signInGoogle() {
        Intent signInIntent = mGoogleSignInClient.getSignInIntent();
        startActivityForResult(signInIntent, RC_SIGN_IN);
    }

    @Override
    public void onFocusChange(View v, boolean hasFocus) {
        switch (v.getId()) {
            case R.id.edEmail:
                if (!hasFocus) {
                    String data = ((EmailEditTextCustom)v).getText().toString();
                    Boolean isEmail = Patterns.EMAIL_ADDRESS.matcher(data).matches();
                    if (data.trim().equals("") || data == null) {
                        inputEmail.setErrorEnabled(true);
                        inputEmail.setError("Please fill your email");
                    } else {
                        if (isEmail) {
                            inputEmail.setError(null);
                            inputEmail.setErrorEnabled(false);
                        } else {
                            inputEmail.setErrorEnabled(true);
                            inputEmail.setError("Not an email");
                        }
                    }
                }
                break;
        }
    }

    @Override
    public void loginSuccess(User user) {
        Common.CURRENT_USER = user;
        if (waitingDialog != null) waitingDialog.dismiss();
        Intent homeIntent = new Intent(getActivity(), HomeActivity.class);
        homeIntent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        startActivity(homeIntent);
        getActivity().finish();
    }

    @Override
    public void loginFailed(String msg) {
        waitingDialog.dismiss();
        Utils.showToastShort(getActivity(), msg, MDToast.TYPE_ERROR);
    }

    @Override
    public void registerFailed(String message) {
        Utils.showToastShort(getActivity(), message, MDToast.TYPE_ERROR);
    }

    @Override
    public void registerSuccess(User user) {
        Common.CURRENT_USER = user;
        Intent homeIntent = new Intent(getActivity(), HomeActivity.class);
        homeIntent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        startActivity(homeIntent);
        getActivity().finish();
    }
}
