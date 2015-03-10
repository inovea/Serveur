/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package interfaces;

import entities.AlertEntity;
import java.util.List;

/**
 *
 * @author Oussama
 */
public interface AlertService {
    public AlertEntity add(AlertEntity alert) throws Exception;
    public void update(AlertEntity alert) throws Exception;
    public void delete(AlertEntity alert) throws Exception;
    
    public AlertEntity getById(long id) throws Exception;
    public List<AlertEntity> getByState(boolean state) throws Exception;
    public List<AlertEntity> getAll() throws Exception;
}
