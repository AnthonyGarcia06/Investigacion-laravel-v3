package com.api.ejemploLaravel.controller;

import com.api.ejemploLaravel.domain.Task;
import com.api.ejemploLaravel.domain.User;
import com.api.ejemploLaravel.jpa.TaskServiceJPA;
import com.api.ejemploLaravel.jpa.UserServiceJPA;
import java.util.Collections;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PatchMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;

/**
 *
 * @author Anthony
 */
@RestController
@RequestMapping("tasks")
public class TaskController {

    @Autowired
    private TaskServiceJPA service;

    @Autowired
    private UserServiceJPA serviceUser;

    @GetMapping("/list")
    @ResponseBody
    public ResponseEntity<Map<String, Object>> list() {
        return ResponseEntity.ok(Collections.singletonMap("data", service.list()));
    }

    @GetMapping("/taskbyid/{id}")
    @ResponseBody
    public ResponseEntity<Map<String, Object>> getTaskById(@PathVariable int id) {
        Task task = service.byId(id);

        if (task == null) {
            return ResponseEntity.notFound().build();
        }

        return ResponseEntity.ok(Collections.singletonMap("task", task));
    }


    @PostMapping("/createtask/{userid}")
    public ResponseEntity<?> create(@RequestBody Task task, @PathVariable int userid) {
        System.out.println(userid+"  user id "+task.toString());
        service.save(task, userid);
        
        return new ResponseEntity<>("Task created successfully", HttpStatus.CREATED);
    }
    
    @DeleteMapping("/deletetask/{id}")
    public ResponseEntity<?> deletePerson(@PathVariable int id) {
        service.delete(id);
        return ResponseEntity.noContent().build();
    }

    @PostMapping("/updatetask")
    @ResponseBody
    public ResponseEntity<Map<String, Object>> updatePerson(@RequestBody Task newTask/*, @PathVariable int id*/) {
        Task t = service.byId(newTask.getId());

        if (t == null) {
            return ResponseEntity.notFound().build();
        }

        t.setTitle(newTask.getTitle());
        t.setDescription(newTask.getDescription());
        t.setDueDate(newTask.getDueDate());
        t.setTaskProgress(newTask.getTaskProgress());
        t.setPriority(newTask.getPriority());
        t.setPhotoUrl(newTask.getPhotoUrl());
        t.setHours(newTask.getHours());
        t.setIsReady(newTask.getIsReady());
        t.setUser(newTask.getUser());

        service.saveForUpdate(t);

        Map<String, Object> response = new HashMap<>();
        response.put("message", "Task updated successfully");
        response.put("task", t);

        return ResponseEntity.noContent().build();
    }
    
    @GetMapping("/activeuser")
    public ResponseEntity<List<User>> getAllActiveUsers() {
        List<User> users = serviceUser.getAllActiveUsers();
        return new ResponseEntity<>(users, HttpStatus.OK);
    }
    
    @GetMapping("/allusers")
    public ResponseEntity<List<User>> getAllUsers() {
        List<User> users = serviceUser.list();
        return new ResponseEntity<>(users, HttpStatus.OK);
    }

}
