package it.hueic.kenhoang.fgshopapp.helper;

import android.os.Bundle;
import android.util.Log;

import com.facebook.CallbackManager;
import com.facebook.FacebookCallback;
import com.facebook.FacebookException;
import com.facebook.GraphRequest;
import com.facebook.GraphResponse;
import com.facebook.login.LoginManager;
import com.facebook.login.LoginResult;

import org.json.JSONException;
import org.json.JSONObject;

import java.net.MalformedURLException;
import java.net.URL;

import it.hueic.kenhoang.fgshopapp.object.User;
import it.hueic.kenhoang.fgshopapp.presenter.login.PresenterLogicLogin;

public class FacebookHelper {

    private static final String TAG = FacebookHelper.class.getName();

    public static void validate(CallbackManager callbackManager, final PresenterLogicLogin presenterLogicLogin) {
        LoginManager.getInstance().registerCallback(callbackManager, new FacebookCallback<LoginResult>() {
            @Override
            public void onSuccess(LoginResult loginResult) {
                GraphRequest request = GraphRequest.newMeRequest(
                        loginResult.getAccessToken(),
                        new GraphRequest.GraphJSONObjectCallback() {
                            @Override
                            public void onCompleted(JSONObject object, GraphResponse response) {
                                Log.v("LoginActivity", response.toString());
                                // Application code
                                Bundle bFacebookData = getFacebookData(object);
                                String email = bFacebookData.getString("email");
                                String id = bFacebookData.getString("idFacebook");
                                int status = presenterLogicLogin.isExists(email);
                                if (status == 200) {
                                    // Get facebook data from login
                                    User user = new User();
                                    user.setName(bFacebookData.getString("first_name") + " " + bFacebookData.getString("last_name"));
                                    user.setUsername(email);
                                    user.setPassword(id);
                                    user.setBirthdate(bFacebookData.getString("birthdate"));
                                    user.setPhone("");
                                    user.setGender(bFacebookData.getString("gender").toUpperCase());
                                    user.setIdentify_number("");
                                    user.setWallet(0);
                                    user.setIs_social("FACEBOOK");
                                    user.setStatus("ACTIVE");
                                    user.setAvatar(bFacebookData.getString("profile_pic"));
                                    presenterLogicLogin.registerUser(user);
                                } else if (status == 400 || status == 401) {
                                    presenterLogicLogin.validateLogin(email, id);
                                }
                            }
                        });
                Bundle parameters = new Bundle();
                parameters.putString("fields", "id, first_name, last_name, email,gender, birthday, location"); // Parámetros que pedimos a facebook
                request.setParameters(parameters);
                request.executeAsync();
            }

            @Override
            public void onCancel() {
                Log.d(TAG, "onCancel: ");
            }

            @Override
            public void onError(FacebookException error) {
                Log.d(TAG, "onError: ");
            }
        });
    }

    private static Bundle getFacebookData(JSONObject object) {

        try {
            Bundle bundle = new Bundle();
            String id = object.getString("id");

            try {
                URL profile_pic = new URL("https://graph.facebook.com/" + id + "/picture?width=200&height=150");
                Log.i("profile_pic", profile_pic + "");
                bundle.putString("profile_pic", profile_pic.toString());

            } catch (MalformedURLException e) {
                e.printStackTrace();
                return null;
            }

            bundle.putString("idFacebook", id);
            if (object.has("first_name"))
                bundle.putString("first_name", object.getString("first_name"));
            if (object.has("last_name"))
                bundle.putString("last_name", object.getString("last_name"));
            if (object.has("email"))
                bundle.putString("email", object.getString("email"));
            if (object.has("gender"))
                bundle.putString("gender", object.getString("gender"));
            if (object.has("birthday"))
                bundle.putString("birthday", object.getString("birthday"));
            //if (object.has("location"))
            //    bundle.putString("location", object.getJSONObject("location").getString("name"));

            return bundle;
        }
        catch(JSONException e) {
            Log.d(TAG,"Error parsing JSON");
        }
        return null;
    }
}
