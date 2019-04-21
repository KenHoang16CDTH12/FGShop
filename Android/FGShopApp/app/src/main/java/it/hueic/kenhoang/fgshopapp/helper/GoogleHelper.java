package it.hueic.kenhoang.fgshopapp.helper;

import android.app.Activity;
import android.content.Context;
import android.net.Uri;
import android.util.Log;

import com.google.android.gms.auth.api.signin.GoogleSignIn;
import com.google.android.gms.auth.api.signin.GoogleSignInAccount;
import com.google.android.gms.auth.api.signin.GoogleSignInClient;
import com.google.android.gms.auth.api.signin.GoogleSignInOptions;
import com.google.android.gms.common.api.ApiException;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import it.hueic.kenhoang.fgshopapp.common.Common;
import it.hueic.kenhoang.fgshopapp.object.User;
import it.hueic.kenhoang.fgshopapp.presenter.login.PresenterLogicLogin;

public class GoogleHelper {

    private static final String TAG = GoogleHelper.class.getName();

    // [START getGoogleSignInClient]
    public static GoogleSignInClient getGoogleSignInClient(Context context) {
        GoogleSignInClient mGoogleSignInClient;
        //Init Google SDK
        // [START configure_signin]
        // Configure sign-in to request the user's ID, email address, and basic
        // profile. ID and basic profile are included in DEFAULT_SIGN_IN.
        GoogleSignInOptions gso = new GoogleSignInOptions.Builder(GoogleSignInOptions.DEFAULT_SIGN_IN)
                .requestEmail()
                .build();
        // [END configure_signin]
        // [START build_client]
        // Build a GoogleSignInClient with the options specified by gso.
        mGoogleSignInClient = GoogleSignIn.getClient(context, gso);
        // [END build_client]
        return mGoogleSignInClient;
    }
    // [END getGoogleSignInClient]

    public static GoogleSignInAccount getAccountGoogle(Context context) {
        // [START on_start_sign_in]
        // Check for existing Google Sign In account, if the user is already signed in
        // the GoogleSignInAccount will be non-null.
        GoogleSignInAccount account = GoogleSignIn.getLastSignedInAccount(context);
        // [END on_start_sign_in]
        return account;
    }

    // [START handleSignInResult]
    public static void handleSignInResult(Task<GoogleSignInAccount> completedTask, Activity activity, PresenterLogicLogin presenterLogicLogin) {
        try {
            GoogleSignInAccount account = completedTask.getResult(ApiException.class);
            if (account != null) {
                String personName = account.getDisplayName();
                String personEmail = account.getEmail();
                String personId = account.getId();
                Uri personPhoto = account.getPhotoUrl();
                int status = presenterLogicLogin.isExists(personEmail);
                if (status == 200) {
                    // Get facebook data from login
                    User user = new User();
                    user.setName(personName);
                    user.setUsername(personEmail);
                    user.setPassword(personId);
                    user.setBirthdate(Common.BIRTHDATE_DEFAULT);
                    user.setPhone("");
                    user.setGender("MALE");
                    user.setIdentify_number("");
                    user.setWallet(0);
                    user.setIs_social("GOOGLE");
                    user.setStatus("ACTIVE");
                    user.setAvatar(personPhoto.toString());
                    presenterLogicLogin.registerUser(user);
                } else if (status == 400 || status == 401) {
                    presenterLogicLogin.validateLogin(personEmail, personId);
                }
            }
        } catch (ApiException e) {
            // The ApiException status code indicates the detailed failure reason.
            // Please refer to the GoogleSignInStatusCodes class reference for more information.
            Log.w(TAG, "signInResult:failed code=" + e.getStatusCode());
        }
    }
    // [END handleSignInResult]

    // [START signOut]
    public static void signOutGoogle(GoogleSignInClient mGoogleSignInClient, Activity activity) {
        mGoogleSignInClient.signOut()
                .addOnCompleteListener(activity, new OnCompleteListener<Void>() {
                    @Override
                    public void onComplete(@NonNull Task<Void> task) {
                        // [START_EXCLUDE]
                        updateUI(null);
                        // [END_EXCLUDE]
                    }
                });
    }
    // [END signOut]

    public static void updateUI(@Nullable GoogleSignInAccount account) {
        if (account != null) {

        } else {

        }
    }

    /**
     * Disconnect Google
     */
    // [START revokeAccess]
    public static void revokeAccess(GoogleSignInClient mGoogleSignInClient, Activity activity) {
        mGoogleSignInClient.revokeAccess()
                .addOnCompleteListener(activity, new OnCompleteListener<Void>() {
                    @Override
                    public void onComplete(@NonNull Task<Void> task) {
                        // [START_EXCLUDE]
                        updateUI(null);
                        // [END_EXCLUDE]
                    }
                });
    }
    // [END revokeAccess]
}
