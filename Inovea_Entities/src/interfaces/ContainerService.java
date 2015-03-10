/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package interfaces;

import entities.Container;
import java.util.List;

/**
 *
 * @author Oussama
 */
public interface ContainerService {
    public Container add(Container container) throws Exception;
    public void update(Container container) throws Exception;
    public void delete(Container container) throws Exception;
    
    public Container getById(Container container) throws Exception;
    public Container getByCoordinates(String lat, String lng) throws Exception;
    public Container getByAddress(String address) throws Exception; //Rechercher abstraite
    public List<Container> getByState(boolean state) throws Exception;
    public void setStateFull(long id) throws Exception;
    public List<Container> getAll() throws Exception;
}
