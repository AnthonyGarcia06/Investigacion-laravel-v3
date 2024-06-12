package com.api.ejemploLaravel.jpa;
import com.api.ejemploLaravel.domain.Task;
import com.api.ejemploLaravel.domain.User;
import com.api.ejemploLaravel.repository.TaskRepository;
import com.api.ejemploLaravel.service.ITaskRepository;
import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Primary;
import org.springframework.stereotype.Service;

/**
 *
 * @author Anthony
 */

@Service
@Primary
public class TaskServiceJPA implements ITaskRepository {
    
    @Autowired
    private TaskRepository repo;
    
     @Autowired
    private UserServiceJPA userservicejpa;

    @Override
    public void save(Task task, int userid) {
       // repo.save(task);
       User u = userservicejpa.byId(userid);
       task.setUser(u);
       repo.save(task);
    }

    @Override
    public List<Task> list() {
         return repo.findAll();
    }

    @Override
    public void delete(int taskid) {
        
        repo.deleteById(taskid);
    }

    @Override
    public Task byId(int taskid) {   
        return repo.findById(taskid).get();   
    }

    @Override
    public void saveForUpdate(Task task) {
        repo.save(task);
    }
    
}
