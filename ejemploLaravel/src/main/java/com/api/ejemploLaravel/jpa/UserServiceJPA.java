
package com.api.ejemploLaravel.jpa;

import com.api.ejemploLaravel.domain.Task;
import com.api.ejemploLaravel.domain.User;
import com.api.ejemploLaravel.repository.UserRepository;
import com.api.ejemploLaravel.service.ITaskRepository;
import com.api.ejemploLaravel.service.IUserRepsitory;
import jakarta.transaction.Transactional;
import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

/**
 *
 * @author Anthony
 */

@Service
public class UserServiceJPA implements IUserRepsitory {

    @Autowired
    private  UserRepository repo;

    @Override
    public void save(User user) {
        throw new UnsupportedOperationException("Not supported yet."); // Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/GeneratedMethodBody
    }

    @Override
    public List<User> list() {
        return repo.findAll();
    }

    @Override
    public void delete(int User) {
        throw new UnsupportedOperationException("Not supported yet."); // Generated from nbfs://nbhost/SystemFileSystem/Templates/Classes/Code/GeneratedMethodBody
    }

    @Override
    public User byId(int user) {
        return repo.findById(user).get();
    }

   @Transactional
   public List<User> getAllActiveUsers() {
        return repo.getAllActiveUsers();
    }
   
    

}
