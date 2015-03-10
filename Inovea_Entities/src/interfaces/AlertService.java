/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package interfaces;

import entities.Alert;
import java.util.List;

/**
 *
 * @author Oussama
 */
public interface AlertService {
    public Alert add(Alert alert) throws Exception;
    public void update(Alert alert) throws Exception;
    public void delete(Alert alert) throws Exception;
    
    public Alert getById(long id) throws Exception;
    public List<Alert> getByState(boolean state) throws Exception;
    public List<Alert> getAll() throws Exception;
}
