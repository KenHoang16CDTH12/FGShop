package it.hueic.kenhoang.fgshopapp.presenter.login;

import it.hueic.kenhoang.fgshopapp.object.User;

public interface IPresenterLogin {
    void validateLogin(String email, String pass);
    void registerUser(User user);
    int isExists(String username);
}
