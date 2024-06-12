
package com.api.ejemploLaravel.repository;

import com.api.ejemploLaravel.domain.User;
import java.util.List;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.jpa.repository.query.Procedure;
import org.springframework.stereotype.Repository;

/**
 *
 * @author Anthony
 */

@Repository
public interface UserRepository  extends JpaRepository<User, Integer> {
    
    //@Query(value = "CALL getAllUsers()", nativeQuery = true)
   //@Procedure(name = "getAllUsers()")
    @Procedure(name = "getAllActiveUsers")
    List<User> getAllActiveUsers();
    
}
