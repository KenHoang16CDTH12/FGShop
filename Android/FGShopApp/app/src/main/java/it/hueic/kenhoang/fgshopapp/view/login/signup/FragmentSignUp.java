package it.hueic.kenhoang.fgshopapp.view.login.signup;

import android.app.AlertDialog;
import android.content.Intent;
import android.os.Bundle;
import androidx.annotation.Nullable;
import com.google.android.material.textfield.TextInputLayout;
import androidx.fragment.app.Fragment;
import android.util.Log;
import android.util.Patterns;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;

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

public class FragmentSignUp extends Fragment implements IViewLogin,
        View.OnClickListener,
        View.OnFocusChangeListener{
    private static final String TAG = FragmentSignUp.class.getSimpleName();
    private static final int RC_SIGN_IN = 9001;
    PresenterLogicLogin presenterLogicLogin;
    EditText edFullname;
    EmailEditTextCustom edEmail;
    PasswordEditTextCustom edPass, edRepass;
    TextInputLayout inputFullName, inputEmail, inputPass, inputRePass;
    Button btnRegister, btnFacebook, btnGoogle;
    boolean isValidateRegister = false;
    CallbackManager callbackManager;
    private GoogleSignInClient mGoogleSignInClient;
    //Alert Dialog
    AlertDialog waitingDialog;

    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_sign_up, container, false);
        //Init Facebook
        FacebookSdk.sdkInitialize(getContext().getApplicationContext());
        AppEventsLogger.activateApp(getContext());
        //Init Google
        mGoogleSignInClient = GoogleHelper.getGoogleSignInClient(getContext());
        //Init Paper
        Paper.init(getContext());
        //Init Presenter
        presenterLogicLogin = new PresenterLogicLogin(this);
        //Init View
        initView(view);
        //Facebook
        callbackManager = CallbackManager.Factory.create();
        FacebookHelper.validate(callbackManager, presenterLogicLogin);

        btnRegister.setOnClickListener(this);
        btnFacebook.setOnClickListener(this);
        btnGoogle.setOnClickListener(this);

        edFullname.setOnFocusChangeListener(this);
        edEmail.setOnFocusChangeListener(this);
        edRepass.setOnFocusChangeListener(this);

        return view;
    }

    private void initView(View view) {
        edFullname = view.findViewById(R.id.edFullName);
        edEmail = view.findViewById(R.id.edEmailAdress);
        edPass = view.findViewById(R.id.edPassword);
        edRepass = view.findViewById(R.id.edRepeatPassword);
        inputFullName = view.findViewById(R.id.inputFullname);
        inputEmail = view.findViewById(R.id.inputEmail);
        inputPass = view.findViewById(R.id.inputPass);
        inputRePass = view.findViewById(R.id.inputRePass);
        btnRegister = view.findViewById(R.id.btnRegister);
        btnFacebook = view.findViewById(R.id.btnFacebook);
        btnGoogle = view.findViewById(R.id.btnGoogle);
    }

    @Override
    public void onClick(View v) {
        int id = v.getId();
        switch (id) {
            case R.id.btnRegister:
                handleRegister();
                break;
            case R.id.btnFacebook:
                LoginManager.getInstance().logInWithReadPermissions(this, Arrays.asList("public_profile", "email"));
                break;
            case R.id.btnGoogle:
                signInGoogle();
                break;
        }
    }

    private void signInGoogle() {
        Intent signInIntent = mGoogleSignInClient.getSignInIntent();
        startActivityForResult(signInIntent, RC_SIGN_IN);
    }

    private void handleRegister() {

        String name = edFullname.getText().toString();
        String email = edEmail.getText().toString();
        String pass = edPass.getText().toString();
        String rePass = edRepass.getText().toString();

        if (isValidateRegister) {
            if (!rePass.equals(pass)) {
                inputRePass.setError("Re-password not same password");
                inputRePass.setErrorEnabled(true);
            } else {
                showDialog();
                User user = new User();

                user.setName(name);
                user.setUsername(email);
                user.setPassword(pass);
                user.setBirthdate(Common.BIRTHDATE_DEFAULT);
                user.setPhone("");
                user.setGender("MALE");
                user.setIdentify_number("");
                user.setWallet(0);
                user.setIs_social("NO");
                user.setStatus("ACTIVE");

                presenterLogicLogin.registerUser(user);
                waitingDialog.dismiss();
            }
        } else {
            Log.d(TAG, "handleRegister: Failed" );
        }
    }

    private void showDialog() {
        waitingDialog = new SpotsDialog.Builder().setContext(getActivity()).build();

        waitingDialog.setCancelable(false);
        waitingDialog.show();
    }

    @Override
    public void onFocusChange(View v, boolean hasFocus) {
        int id = v.getId();
        switch (id) {
            case R.id.edFullName:
                if (!hasFocus) {
                    String data = ((EditText)v).getText().toString();
                    if (data.trim().equals("") || data == null) {
                        inputFullName.setErrorEnabled(true);
                        inputFullName.setError("Please fill your name");
                        isValidateRegister = false;
                    } else {
                        inputFullName.setErrorEnabled(false);
                        inputFullName.setError("");
                        isValidateRegister = true;
                    }
                }
                break;
            case R.id.edEmailAdress:
                if (!hasFocus) {
                    String data = ((EmailEditTextCustom)v).getText().toString();
                    Boolean isEmail = Patterns.EMAIL_ADDRESS.matcher(data).matches();
                    if (data.trim().equals("") || data == null) {
                        inputEmail.setErrorEnabled(true);
                        inputEmail.setError("Please fill your email");
                        isValidateRegister = false;
                    } else {
                        if (isEmail) {
                            inputEmail.setErrorEnabled(false);
                            inputEmail.setError("");
                            isValidateRegister = true;
                        } else {
                            inputEmail.setErrorEnabled(true);
                            inputEmail.setError("Not an email");
                            isValidateRegister = false;
                        }

                    }
                }
                break;
            case R.id.edRepeatPassword:
                if (!hasFocus) {
                    String data = ((EditText) v).getText().toString();
                    if (data.trim().equals("") || data == null) {
                        inputRePass.setErrorEnabled(true);
                        inputRePass.setError("Please fill your re-password");
                        isValidateRegister = false;
                    } else {
                        if (!data.equals(edPass.getText().toString())) {
                            inputRePass.setErrorEnabled(true);
                            inputRePass.setError("Re-password not same password");
                            isValidateRegister = false;
                        } else {
                            inputRePass.setErrorEnabled(false);
                            inputRePass.setError("");
                            isValidateRegister = true;
                        }
                    }
                }
                break;
        }
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
        if (waitingDialog != null) waitingDialog.dismiss();
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
