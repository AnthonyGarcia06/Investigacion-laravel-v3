package com.api.ejemploLaravel.domain;

import com.fasterxml.jackson.annotation.JsonBackReference;
import com.fasterxml.jackson.annotation.JsonIdentityInfo;
import com.fasterxml.jackson.annotation.JsonIdentityReference;
import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonManagedReference;
import com.fasterxml.jackson.annotation.ObjectIdGenerators;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.EnumType;
import jakarta.persistence.Enumerated;
import jakarta.persistence.FetchType;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import java.util.Date;

/**
 *
 * @author Anthony
 */

//@JsonIdentityInfo(generator = ObjectIdGenerators.PropertyGenerator.class, property = "id")  //esta linea es para que se vieran los id de usuario sin enciclarse
//tambien se ponia en user abajo del @Entity
@Entity
@JsonIdentityInfo(generator = ObjectIdGenerators.PropertyGenerator.class, property = "id")
public class Task {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)  
    private int id;

    private String title;
    private String description;
    private Date dueDate;

    public enum TaskProgress {
        PENDING,
        IN_PROGRESS,
        DONE
    }
    
    @Enumerated(EnumType.STRING)
    private TaskProgress taskProgress = TaskProgress.PENDING;

    public enum Priority {
        LOW,
        MID,
        HIGH
    }
     @Enumerated(EnumType.STRING)
    private Priority priority = Priority.LOW;
    
      private String photoUrl;
    private Integer hours;
    
    @Column(name = "is_active", columnDefinition = "char(1) DEFAULT '0' ")
    private Boolean isReady = false;

   // @JsonIgnore
    @ManyToOne(optional=false)
    @JoinColumn(name = "user_id", nullable=false)
    @JsonIdentityReference(alwaysAsId = false)
    private User user;

    
    public Task() {
    }

    public Task(int id, String title, String description, Date dueDate, String photoUrl, Integer hours, User user) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.dueDate = dueDate;
        this.photoUrl = photoUrl;
        this.hours = hours;
        this.user = user;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public Date getDueDate() {
        return dueDate;
    }

    public void setDueDate(Date dueDate) {
        this.dueDate = dueDate;
    }

    public TaskProgress getTaskProgress() {
        return taskProgress;
    }

    public void setTaskProgress(TaskProgress taskProgress) {
        this.taskProgress = taskProgress;
    }

    public Priority getPriority() {
        return priority;
    }

    public void setPriority(Priority priority) {
        this.priority = priority;
    }

    public String getPhotoUrl() {
        return photoUrl;
    }

    public void setPhotoUrl(String photoUrl) {
        this.photoUrl = photoUrl;
    }

    public Integer getHours() {
        return hours;
    }

    public void setHours(Integer hours) {
        this.hours = hours;
    }

    public Boolean getIsReady() {
        return isReady;
    }

    public void setIsReady(Boolean isReady) {
        this.isReady = isReady;
    }

    public User getUser() {
        return user;
    }

    public void setUser(User user) {
        this.user = user;
    }

    @Override
    public String toString() {
        return "Task{" + "id=" + id + ", title=" + title + ", description=" + description + ", dueDate=" + dueDate + ", taskProgress=" + taskProgress + ", priority=" + priority + ", photoUrl=" + photoUrl + ", hours=" + hours + ", isReady=" + isReady + ", user=" + user + '}';
    }
    
}
