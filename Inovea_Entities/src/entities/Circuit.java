/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entities;

import java.util.List;

/**
 *
 * @author Oussama
 */
public class Circuit {
    private long id;
    private boolean state;
    private List<Container> containers;

    public Circuit() {
    }

    public Circuit(long id, boolean state, List<Container> containers) {
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

    public List<Container> getContainers() {
        return containers;
    }

    public void setContainers(List<Container> containers) {
        this.containers = containers;
    }

    @Override
    public String toString() {
        return "Circuit{" + "id=" + id + ", state=" + state + ", containers=" + containers + '}';
    }
    
    
}
