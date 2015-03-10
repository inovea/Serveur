/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entities;

import java.io.Serializable;
import java.util.List;
import javax.persistence.CascadeType;
import javax.persistence.Entity;
import javax.persistence.FetchType;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.OneToMany;

/**
 *
 * @author Oussama
 */
@Entity
public class SteedEntity implements Serializable{
    @Id
    @GeneratedValue
    private long id;
    private String mail;
    private String password;
    private String name;
    private String firstname;
    @OneToMany(fetch = FetchType.LAZY, cascade = CascadeType.DETACH)
    private List<CircuitEntity> circuits;

    public SteedEntity() {
    }

    public SteedEntity(String mail, String password, String name, String firstname) {
        this.mail = mail;
        this.password = password;
        this.name = name;
        this.firstname = firstname;
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public String getMail() {
        return mail;
    }

    public void setMail(String mail) {
        this.mail = mail;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getFirstname() {
        return firstname;
    }

    public void setFirstname(String firstname) {
        this.firstname = firstname;
    }

    @Override
    public String toString() {
        return "Steed{" + "id=" + id + ", mail=" + mail + ", password=" + password + ", name=" + name + ", firstname=" + firstname + '}';
    }
    
    
}
