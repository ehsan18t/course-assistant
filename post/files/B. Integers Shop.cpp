#include<bits/stdc++.h>
using namespace std;
typedef long long int ll;

//not done yet.......
int main(){
    int t;
    cin>>t;

    while(t--){
        int n;
        cin>>n;
        ll l,r,c,mi,mx,coin,ans,mxCoin,mxNum;
        std::vector<pair<ll,pair<ll,ll>>> v;
        std::vector<ll> output;
        for(int i=0;i<n;i++){
           cin>>l>>r>>c;
           v.push_back(make_pair(l,make_pair(r,c)));
        }
        // for(int i=0;i<v.size();i++){
        //     cout<<v[i].first<<" "
        //       <<v[i].second.first<<" "
        //       <<v[i].second.second<<endl;
        // }
        output.push_back(v[0].second.second);
        mi = v[0].first;
        mx = v[0].second.first;
        coin = v[0].second.second;
        mxCoin = coin;
        mxNum = mx;
        for(int i=1;i<n;i++){
            l = v[i].first;
            r =v[i].second.first;
            c = v[i].second.second;
            
            if(mi<l){
                if(mxNum>r){
                  mxCoin = c;
                  mxNum = r;
                  output.push_back(coin+mxCoin);
                } 
                else if(mxNum==l){
                    if(mxCoin>c)mxNum = c;
                    output.push_back(mxCoin);
                }else{
                    output.push_back(mxCoin);
                }
            }else if(mi>l){
                if(mxNum>r){
                  mxCoin = c;
                  mxNum = r;
                  output.push_back(coin+mxCoin);
                } 
                else if(mxNum==l){
                    if(mxCoin>c)mxNum = c;
                    output.push_back(mxCoin);
                }else{
                    output.push_back(mxCoin);
                }
            }



        }  
      

    }
}