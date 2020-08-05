import React, { Component } from 'react';
import './Cards.css';
import axios from 'axios';

export default class Cards extends Component {

  constructor(props){
    
    super(props);
    this.state = {
      total_player : 0,
      respObj : ''
    }

    //binding functions 
    this.distribute = this.distribute.bind(this);
    this.onChange = this.onchange.bind(this);
  }

  //eventHandling distribution of cards
  distribute(e){
    e.preventDefault();

    if(this.state.total_player > 0){
      
      this.setState({ respObj: '' });
      var component = this;
      let baseUrl = "/playing_cards/distribute-cards.php";

      axios.post(baseUrl,this.state.total_player)
      .then(res => {
        let data = res.data;
        component.setState({respObj: data});
      })
      .catch(err => {
        console.log(err);
      })
    }else{
      alert("Invalid No of players!!");
    }
  }
  
  //eventHandling no of players
  onchange(e){
      this.setState({[e.target.name]:e.target.value});
      this.setState({respObj:''});
  }

  render() {
    var distributedCards = (this.state.total_player>0) ? this.state.respObj : '';
    return (
      <div className="row">
        <h2>52-cards deck is ready to distribute</h2>
        <p>Enter total no. of player and submit to check card distribution details</p>
        <div className="container">
          <div className="row">
            <div className="col-25">
              <label htmlFor="total_player">Total Players</label>
            </div>
            <div className="col-75">
              <input type="number" id="total_player" onChange={this.onChange} name="total_player"  placeholder="Total Players"></input>
            </div>
          </div>
          <br/>
          <div className="row">
            <input type="submit" value="Submit" onClick={this.distribute} ></input>
          </div>
          <div className="row" id="result_card_detail">
            {
              Object.values(distributedCards).map((value)=>(
                <p>{value}</p>
              ))
            }
          </div>
        </div>
      </div>
    )
  }
}