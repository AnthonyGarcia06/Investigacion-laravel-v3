
package com.api.ejemploLaravel.service;

import com.api.ejemploLaravel.domain.Task;
import java.util.List;

/**
 *
 * @author Anthony
 */
public interface ITaskRepository {
    
    void save(Task task, int userId);
    List<Task> list();
    void delete(int taskid);
    Task byId(int taskid);
    void saveForUpdate(Task task);
    
}
