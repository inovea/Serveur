/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entities;

/**
 *
 * @author Oussama
 */
public class Alert {
    private long id;
    private boolean state;
    private String description;

    public Alert() {
    }

    public Alert(long id, boolean state, String description) {
        this.id = id;
        this.state = state;
        this.description = description;
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

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    @Override
    public String toString() {
        return "Alert{" + "id=" + id + ", state=" + state + ", description=" + description + '}';
    }
    
    
}
