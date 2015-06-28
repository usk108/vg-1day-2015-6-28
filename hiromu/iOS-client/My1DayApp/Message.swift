//
//  Message.swift
//  My1DayApp
//
//  Created by 清 貴幸 on 2015/05/15.
//  Copyright (c) 2015年 VOYAGE GROUP, inc. All rights reserved.
//

import UIKit

class Message {
    let identifier: Int!
    let body: String!
    let icon: UIImage?
    let date: String!
    let name: String!
    // Mission1-1. created_at 用のインスタンス変数を追加
    
    init?(dictionary: [String: AnyObject]) {
        // Mission1-1 Dictionary から key:created_at の値を取得
        if let identifier = dictionary["id"] as? Int, body = dictionary["body"] as? String, icon = dictionary["icon"] as? String, date = dictionary["created_at"] as? String,name = dictionary["username"] as? String{
            self.identifier = identifier
            self.body = body
            self.icon = ImageHelper.imageWithBase64EncodedString(icon)
            self.date = date
            self.name = name
            
            
            // Mission1-1 Dictionary から取得した値を created_at 用のインスタンス変数に追加
        } else {
            self.identifier = nil
            self.body = nil
            self.icon = nil
            self.date = nil
            self.name = nil
            // Mission1-1 インスタンス変数を nil で初期化
            return nil
        }
    }
}
