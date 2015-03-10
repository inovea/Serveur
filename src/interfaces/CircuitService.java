/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package interfaces;

import entities.CircuitEntity;
import java.util.List;

/**
 *
 * @author Oussama
 */
public interface CircuitService {
    public CircuitEntity add(CircuitEntity circuit) throws Exception;
    public void update(CircuitEntity circuit) throws Exception;
    public void delete(CircuitEntity circuit) throws Exception;
    
    public CircuitEntity getById(long id) throws Exception;
    public List<CircuitEntity> getByState(boolean state) throws Exception;
    public void setState(long id, boolean state) throws Exception;
    public List<CircuitEntity> getAll() throws Exception;
}
