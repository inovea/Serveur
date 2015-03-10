/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package interfaces;

import entities.ContainerEntity;
import java.util.List;

/**
 *
 * @author Oussama
 */
public interface ContainerService {
    public ContainerEntity add(ContainerEntity container) throws Exception;
    public void update(ContainerEntity container) throws Exception;
    public void delete(ContainerEntity container) throws Exception;
    
    public ContainerEntity getById(long id) throws Exception;
    public ContainerEntity getByCoordinates(String lat, String lng) throws Exception;
    public ContainerEntity getByAddress(String address) throws Exception; //Rechercher abstraite
    public List<ContainerEntity> getByState(boolean state) throws Exception;
    public void setStateFull(long id) throws Exception;
    public List<ContainerEntity> getAll() throws Exception;
}
