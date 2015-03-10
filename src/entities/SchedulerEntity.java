/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entities;

import java.io.Serializable;
import java.util.List;
import javax.persistence.Entity;
import javax.persistence.Id;


/**
 *
 * @author Oussama
 */
@Entity
public class SchedulerEntity extends SteedEntity implements Serializable{
    
    public SchedulerEntity() {
    }

    public SchedulerEntity(String mail, String password, String name, String firstname) {
        super(mail, password, name, firstname);
    }

  
    
}
