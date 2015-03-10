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
public class CircuitEntity implements Serializable{
    @Id
    @GeneratedValue
    private long id;
    private boolean state;
    @OneToMany(fetch = FetchType.EAGER, cascade = CascadeType.DETACH)
    private List<ContainerEntity> containers;

    public CircuitEntity() {
    }

    public CircuitEntity(long id, boolean state, List<ContainerEntity> containers) {
        this.id = id;
        this.state = state;
        this.containers = containers;
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public boolean isState() {
        return state;
    }

    public void setState(boolean state) {
        this.state = state;
    }

    public List<ContainerEntity> getContainers() {
        return containers;
    }

    public void setContainers(List<ContainerEntity> containers) {
        this.containers = containers;
    }

    @Override
    public String toString() {
        return "Circuit{" + "id=" + id + ", state=" + state + ", containers=" + containers + '}';
    }
    
    
}
