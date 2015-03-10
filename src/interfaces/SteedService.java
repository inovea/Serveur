/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package interfaces;

import entities.SteedEntity;
import java.util.List;

/**
 *
 * @author Oussama
 */
public interface SteedService {
    public SteedEntity add(SteedEntity steed) throws Exception;
    public void update(SteedEntity steed) throws Exception;
    public void delete(SteedEntity steed) throws Exception;
    
    public SteedEntity getById(long id) throws Exception;
    public SteedEntity getBymail(String mail) throws Exception;
    public SteedEntity getByName(String name, String firstname) throws Exception;
    public List<SteedEntity> getAll() throws Exception;
}
