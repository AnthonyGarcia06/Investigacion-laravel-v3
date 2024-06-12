package com.api.ejemploLaravel.service;

import com.api.ejemploLaravel.domain.User;
import java.util.List;

/**
 *
 * @author Anthony
 */
public interface IUserRepsitory {
    
    void save(User user);
    List<User> list();
    void delete(int User);
    User byId(int user);
   //List<User> listUsersSP();
    
}
