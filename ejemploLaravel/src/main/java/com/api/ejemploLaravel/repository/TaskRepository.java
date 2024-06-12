
package com.api.ejemploLaravel.repository;

import com.api.ejemploLaravel.domain.Task;
import com.api.ejemploLaravel.domain.User;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

/**
 *
 * @author Anthony
 */

@Repository
public interface TaskRepository extends JpaRepository<Task, Integer>{
    
    
    
}
