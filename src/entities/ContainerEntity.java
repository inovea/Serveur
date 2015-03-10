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
public class ContainerEntity implements Serializable{
    @Id
    @GeneratedValue
    private long id;
    private String lat;
    private String lng;
    private String address;
    private boolean state;
    @OneToMany(fetch = FetchType.LAZY, cascade = CascadeType.REMOVE)
    private List<AlertEntity> alerts;

    public ContainerEntity() {
    }

    public ContainerEntity(long id, String lat, String lng, String address, boolean state, List<AlertEntity> alerts) {
        this.id = id;
        this.lat = lat;
        this.lng = lng;
        this.address = address;
        this.state = state;
        this.alerts = alerts;
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public String getLat() {
        return lat;
    }

    public void setLat(String lat) {
        this.lat = lat;
    }

    public String getLng() {
        return lng;
    }

    public void setLng(String lng) {
        this.lng = lng;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public boolean isState() {
        return state;
    }

    public void setState(boolean state) {
        this.state = state;
    }

    public List<AlertEntity> getAlerts() {
        return alerts;
    }

    public void setAlerts(List<AlertEntity> alerts) {
        this.alerts = alerts;
    }

    @Override
    public String toString() {
        return "Container{" + "id=" + id + ", lat=" + lat + ", lng=" + lng + ", address=" + address + ", state=" + state + ", alerts=" + alerts + '}';
    }

    
            
    
}
